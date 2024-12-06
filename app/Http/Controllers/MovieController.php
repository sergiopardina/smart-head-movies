<?php

namespace App\Http\Controllers;

use App\Http\Requests\Movie\MovieFilterRequest;
use App\Http\Requests\Movie\MovieStateUpdateRequest;
use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Models\State;
use Exceptions\DomainException;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MovieFilterRequest $movieFilterRequest): JsonResponse
    {
        $movies = Movie::query()
            ->byIds($movieFilterRequest->validated('filters.ids'))
            ->byGenreIds($movieFilterRequest->validated('filters.genre_ids'))
            ->where('state_id', State::PUBLISHED_ID)
            ->paginate(5); // Пагинацию можно реализовать через класс Paginator, добавить PaginationRequest и получать с фронтенда кол-во записей на стр
        // Фильтрацию можно реализовать более заумно и универсально (например с помощью сторонних библиотек), это простая реализация для конкретной задачи

        return response()->json([
            'status' => 'success',
            'data' => MovieResource::collection($movies),
        ]);
    }

    public function allMovies(MovieFilterRequest $movieFilterRequest): JsonResponse
    {
        $movies = Movie::query()
            ->byIds($movieFilterRequest->validated('filters.ids'))
            ->byGenreIds($movieFilterRequest->validated('filters.genre_ids'))
            ->paginate(5);

        return response()->json([
            'status' => 'success',
            'data' => MovieResource::collection($movies),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieStoreRequest $movieStoreRequest): JsonResponse
    {
        $movieStoreRequest->validated('poster') ? $poster = $movieStoreRequest->file('poster')->store('posters', 'public') : $poster = 'https://pin.it/4rTBkUTox';
        $movie = new Movie();

        $movie->name = $movieStoreRequest->validated('name');
        $movie->state_id = State::CREATED_ID;
        $movie->poster_path = $poster;
        // Можно реализовать запись связанных жанров так, а можно отдельным контроллером (в ТЗ не уточняется)

        $movie->save();

        $movie->genres()->sync($movieStoreRequest->validated('genres'));

        return response()->json([
            'status' => 'success',
            'message' => 'Фильм успешно создан',
            'data' => new MovieResource($movie),
        ]);
    }

    /**
     * Display the specified resource.
     * @throws DomainException
     */
    public function show(int $id): JsonResponse
    {
        $movie = Movie::query()->find($id);

        if (!$movie) {
            throw new DomainException('Фильм не найден');
        }

        return response()->json([
            'status' => 'success',
            'data' => new MovieResource($movie),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws DomainException
     */
    public function update(MovieUpdateRequest $movieUpdateRequest, int $id): JsonResponse
    {
        $movie = Movie::query()->find($id);

        if (!$movie) {
            throw new DomainException('Фильм не найден');
        }

        $movie->name = $movieUpdateRequest->validated('name');
        $movie->poster_path = $movieUpdateRequest->file('poster')->store('posters', 'public');

        $movie->save();

        $movie->genres()->sync($movieUpdateRequest->validated('genres'));

        return response()->json([
            'status' => 'success',
            'message' => 'Фильм успешно обновлён',
            'data' => new MovieResource($movie),
        ]);
    }

    /**
     * @throws DomainException
     */
    public function stateUpdate(MovieStateUpdateRequest $movieStateUpdateRequest, int $id): JsonResponse
    {
        $movie = Movie::query()->find($id);

        if (!$movie) {
            throw new DomainException('Фильм не найден');
        }

        $movie->state_id = $movieStateUpdateRequest->validated('state_id');

        $movie->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Статус фильма успешно обновлён',
            'data' => new MovieResource($movie),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @throws DomainException
     */
    public function destroy(int $id): JsonResponse
    {
        $movie = Movie::query()->find($id);

        if (!$movie) {
            throw new DomainException('Фильм не найден');
        }

        $movie->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Фильм успешно удалён',
        ]);
    }
}
