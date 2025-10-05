<a href="{{ route('customers.edit',$customer->id) }}" class="btn btn-sm btn-success">Güncelle</a>
<form action="{{ route('customers.destroy',$customer->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Silinsin mi?')">Sil</button>
</form>
