<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class StoreDestinoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;  // Permitir que cualquier usuario pueda hacer esta solicitud 
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoria_id' => 'sometimes|exists:categorias,id', // La categoria_id es opcional y debe existir en la tabla categorias
            'nombre' => 'sometimes|string|max:255', // El titulo es opcional, debe ser una cadena y no debe exceder los 255 caracteres
            'descripcion' => 'sometimes|string', // La descripcion es opcional y debe ser una cadena
            'precio' => 'sometimes|string', // Los ingredientes son opcionales y deben ser una cadena
            'fecha_inicio' => 'sometimes|string', // Las instrucciones son opcionales y deben ser una cadena
            'imagen' => 'sometimes|image|max:2048', // La imagen es opcional, debe ser un archivo de imagen y no debe exceder los 2MB
        ];
    }
}