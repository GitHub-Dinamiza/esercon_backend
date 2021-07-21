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
                'otros_requerimientos'=> 'required',
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
                'condiciones_economicas.*.otro_condicion_econoimica' => '',
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




              /*   "tiposVias": [
                         {"tipovia_id": "1" },
                         {"tipovia_id": "2" },
                         {"tipovia_id": "4", "otros": "bambu"}
                     ],

                 "rellenos": [
                         {"tipo_material_id": "1"}

                    ],
                  "costoServicio":[
                       {
                           "servicio_id": "1",
                           "otro_servicio": "prueba servicio7",
                           "proveedor_id": "1",
                           "forma_pago": "Diaria",
                           "medio_pago": "Efectivo",
                           "otro_medio_pago":"",
                           "pago_a_realizar": "Esercon",
                           "detalle":[
                                  {
                                      "tipo_costo_servicio_id":"1",
                                      "otro_costo_servicio":"almuerzo ",
                                      "valor":"10000"
                                   }
                                ]
                       },
                        {
                           "servicio_id": "2",
                           "otro_servicio": "prueba servicio8",
                           "proveedor_id": "1",
                           "forma_pago": "Diaria",
                           "medio_pago": "Efectivo",
                           "otro_medio_pago":"",
                           "pago_a_realizar": "Esercon",
                           "detalle":[
                                  {

                                      "tipo_costo_servicio_id":"4",
                                      "otro_costo_servicio":"almuerzo ",
                                      "valor":"10000"
                                   }
                                ]
                       }
                  ],
                  "condiciones_economicas":[
                                              {
                                                  "nombre_condicion_economica_id":"1",
                                                  "otro_condicion_econoimica":"",
                                                  "pago_a_realizar":"Proveedor",
                                                  "forma_pago":"Semanal",
                                                  "medio_pago":"Tranferencia",
                                                  "otro_medio_pago":""
                                              }

                                          ],
                  "datos_operacion":{
                                          "consumo_combustible_dia":"0",
                                          "consumo_lubricante_dia":"0",
                                          "consumo_refrigerante_dia":"0",
                                          "consumo_grasa":"0",
                                          "consumo_llantas_dia":"0",
                                          "pago_peajes":"0",
                                          "pago_conductor_dia":"0",
                                          "pago_hidratacion_dia":"0",
                                          "pago_parqueadero_dia":"0",
                                          "pago_soat_dia":"0",
                                          "pago_tecnomecanica_dia":"0",
                                          "pago_seguro_dia":"0",
                                          "pago_leasing_dia":"0",
                                          "pago_lavado_dia":"0",
                                          "pago_mantenimiento_dia":"0",
                                          "pago_admin_dia":"0"
                  },
                  "datos_administracion":{
                                          "salario_conductor_dia":"0",
                                          "salario_gerencia_nacional_operaciones_dia":"0",
                                          "salario_gerencia_regional_operaciones_dia":"0",
                                          "salario_gerencia_recursos_humanos_dia":"0",
                                          "salario_asistente_recursos_humanos_dia":"0",
                                          "salario_gerencia_administracion_dia":"0",
                                          "salarios_upervisor_asignado_dia":"0",
                                          "pago_arriendo_oficina_dia":"0",
                                          "pagos_servicios_oficina_dia":"0",
                                          "pago_alojamiento_dia":"0",
                                          "pago_alimentacion_dia":"0",
                                          "pago_alquiler_camionetas_dia":"0",
                                          "pago_tiquetes_aereos_dia":"0",
                                          "pago_transporte_terrestre_dia":"0",
                                          "pago_gasolina_camionetas_dia":"0",
                                          "pago_papeleria_dia":"0",
                                          "pago_insumos_oficina_dia":"0",
                                          "pago_gastos_oficina":"0"
                  },
                  "recorridos":[
                      {
                          "recorrido_inicio_id":"1",
                          "recorrido_final_id":"2",
                          "accion_id":"2"
                      },
                      {
                          "recorrido_inicio_id":"2",
                          "recorrido_final_id":"1",
                          "accion_id":"1"
                      },
                      {
                          "recorrido_inicio_id":"1",
                          "recorrido_final_id":"3",
                          "accion_id":"2"
                      }
                  ]
              */



        ];
    }
}
