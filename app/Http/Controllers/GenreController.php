<?php

namespace App\Http\Controllers;

use App\Http\Requests\Genre\GenreStoreRequest;
use App\Http\Requests\Genre\GenreUpdateRequest;
use App\Http\Resources\GenreResource;
use App\Models\Genre;
use Exceptions\DomainException;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => GenreResource::collection(Genre::query()->paginate(5)),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(GenreStoreRequest $genreStoreRequest): JsonResponse
    {
        $genre = new Genre();
        $genre->name = $genreStoreRequest->validated('name');
        $genre->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Жанр успешно создан',
            'data' => new GenreResource($genre),
        ]);
    }

    /**
     * Display the specified resource.
     * @throws DomainException
     */
    public function show(int $id): JsonResponse
    {
        $genre = Genre::query()->find($id);

        if (!$genre) {
            throw new DomainException('Жанр не найден');
        }

        return response()->json([
            'status' => 'success',
            'data' => new GenreResource($genre),
        ]);
    }

    /**
     * Update the specified resource in storage.
     * @throws DomainException
     */
    public function update(GenreUpdateRequest $genreUpdateRequest, int $id): JsonResponse
    {
        $genre = Genre::query()->find($id);

        if (!$genre) {
            throw new DomainException('Жанр не найден');
        }

        $genre->name = $genreUpdateRequest->validated('name');
        $genre->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Жанр успешно обновлён',
            'data' => new GenreResource($genre),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @throws DomainException
     */
    public function destroy(int $id): JsonResponse
    {
        $genre = Genre::query()->find($id);

        if (!$genre) {
            throw new DomainException('Жанр не найден');
        }

        $genre->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Жанр успешно удалён',
        ]);
    }
}
