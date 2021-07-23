<?php

namespace App\Http\Requests\Proyecto;

use Illuminate\Foundation\Http\FormRequest;

class CreateProyectoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

                'codigo'=> 'required|unique:proyectos,codigo',
                'nombre'=> 'required|unique:proyectos,nombre',
                'fecha_inicio'=> 'required',
                'fecha_fin'=> 'required|date|after:fecha_inicio',
                'municipio_inicio'=> 'required',
                'ubicacion_inicial'=> 'required',
                'municipio_final'=> 'required',
                'ubicacion_final'=> 'required',
                'horas_laboral'=> 'required',
                'temperatura'=> 'required',
                'propietario_dobletroque'=>'required',
                'duracion_proyecto'=> 'required',
                'cantidad_vehiculo_propio'=> 'required',
                'cantidad_vehiculo_alquilado'=> 'required',
                'valor_metrocubico_propio'=> 'required',
                'valor_metrocubico_alquilado'=> 'required',
                'valor_contrato'=> 'required',
                'valor_anticipo_contrato'=> 'required',

                'antiguedad_vehiculo'=> 'required',
                'otros_requerimientos'=> '',
                'tiposVias'=>'required|array',
                'tiposVias.*.tipovia_id'=>'required',
                'rellenos'=>'required|array',
                'rellenos.*.tipo_material_id'=>'required',

                'costoServicio'=> 'required|array',
                'costoServicio.*.servicio_id'=>'required',
                'costoServicio.*.otro_servicio'=>'required_if:costoServicio.*.servicio_id,4|unique:servicios,nombre',
                'costoServicio.*.proveedor_id'=>'required',
                'costoServicio.*.forma_pago'=>'required',
                'costoServicio.*.medio_pago'=>'required',
                'costoServicio.*.otro_medio_pago'=>'required_if:costoServicio.*.medio_pago,Otros',
                'costoServicio.*.pago_a_realizar'=>'required',

                'costoServicio.*.detalle'=>'required|array',
                'costoServicio.*.detalle.*.tipo_costo_servicio_id'=> 'required',
                'costoServicio.*.detalle.*.otro_costo_servicio'=>'required_if:costoServicio.*.detalle.*.tipo_costo_servicio_id,4|unique:tipo_costo_servicio,nombre',
                'costoServicio.*.detalle.*.valor'=>'required',

                'condiciones_economicas' => 'required|array',
                'condiciones_economicas.*.nombre_condicion_economica_id' => 'required',
                'condiciones_economicas.*.otro_condicion_econoimica' => 'required_if:condiciones_economicas.*.nombre_condicion_economica_id,4',
                'condiciones_economicas.*.pago_a_realizar' => 'required',
                'condiciones_economicas.*.forma_pago' => 'required',
                'condiciones_economicas.*.medio_pago' => 'required',
                'condiciones_economicas.*.otro_medio_pago' => '',

                'datos_operacion'=>'required',
                'datos_operacion.consumo_combustible_dia'=>'required',
                'datos_operacion.consumo_lubricante_dia'=>'required',
                'datos_operacion.consumo_refrigerante_dia'=>'required',
                'datos_operacion.consumo_grasa'=>'required',
                'datos_operacion.consumo_llantas_dia'=>'required',
                'datos_operacion.pago_peajes'=>'required',
                'datos_operacion.pago_conductor_dia'=>'required',
                'datos_operacion.pago_hidratacion_dia'=>'required',
                'datos_operacion.pago_parqueadero_dia'=>'required',
                'datos_operacion.pago_soat_dia'=>'required',
                'datos_operacion.pago_tecnomecanica_dia'=>'required',
                'datos_operacion.pago_seguro_dia'=>'required',
                'datos_operacion.pago_leasing_dia'=>'required',
                'datos_operacion.pago_lavado_dia'=>'required',
                'datos_operacion.pago_mantenimiento_dia'=>'required',
                'datos_operacion.pago_admin_dia'=>'required',

                'datos_administracion' =>'required',
                'datos_administracion.salario_conductor_dia'=>'required',
                'datos_administracion.salario_gerencia_nacional_operaciones_dia'=>'required',
                'datos_administracion.salario_gerencia_regional_operaciones_dia'=>'required',
                'datos_administracion.salario_gerencia_recursos_humanos_dia'=>'required',
                'datos_administracion.salario_asistente_recursos_humanos_dia'=>'required',
                'datos_administracion.salario_gerencia_administracion_dia'=>'required',
                'datos_administracion.salarios_upervisor_asignado_dia'=>'required',
                'datos_administracion.pago_arriendo_oficina_dia'=>'required',
                'datos_administracion.pagos_servicios_oficina_dia'=>'required',
                'datos_administracion.pago_alojamiento_dia'=>'required',
                'datos_administracion.pago_alimentacion_dia'=>'required',
                'datos_administracion.pago_alquiler_camionetas_dia'=>'required',
                'datos_administracion.pago_tiquetes_aereos_dia'=>'required',
                'datos_administracion.pago_transporte_terrestre_dia'=>'required',
                'datos_administracion.pago_gasolina_camionetas_dia'=>'required',
                'datos_administracion.pago_papeleria_dia'=>'required',
                'datos_administracion.pago_insumos_oficina_dia'=>'required',
                'datos_administracion.pago_gastos_oficina'=>'required',

                'recorridos' => 'required',
                'recorridos.*.recorrido_inicio_id'=>'required',
                'recorridos.*.recorrido_final_id'=>'required',
                'recorridos.*.accion_id'=>'required',





        ];
    }
}
