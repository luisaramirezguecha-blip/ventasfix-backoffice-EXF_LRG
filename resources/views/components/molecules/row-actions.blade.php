@props(['showRoute', 'editRoute', 'deleteRoute'])
<a href="{{ $showRoute }}" class="action-link link-bronze">Ver</a>
<a href="{{ $editRoute }}" class="action-link link-bronze">Editar</a>
<form action="{{ $deleteRoute }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="action-btn" onclick="return confirm('¿Seguro que deseas eliminar este registro?')">Eliminar</button>
</form>
