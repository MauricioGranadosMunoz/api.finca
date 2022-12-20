import { cajuelaApi } from "../../../api/fincaAPI";
import { setCajuelasError, setCajuelasSemana } from "./cajuelaSlice";

const addCajuelaSemana = (CAJUELAS_JSON_SEMANA,  usuario) => {

    return async( dispatch, getState ) => {

        const { data } = await cajuelaApi.post(
            `/addCajuelaSemana.php`,
            {
                "CAJUELAS_JSON_SEMANA": JSON.stringify(CAJUELAS_JSON_SEMANA),
                "ADMINISTRADOR_ID": usuario.USUARIO_ID
            },
            { 
                headers: {
                    "Authorization" : `Bearer ${usuario.TOKEN}`
                }
            }
        )
}}

const obtenerCajuelaSemana = (TOKEN) => {

    return async( dispatch, getState ) => {

        const { data } = await cajuelaApi.post(
            `/obtenerCajuelasSemana.php`,
            { },
            { 
                headers: {
                    "Authorization" : `Bearer ${TOKEN}`
                }
            }
        )
        const isEmpty = Object.keys(data).length === 0;
        if (!isEmpty) {
            dispatch(setCajuelasSemana({
                cajuelaSemana: data
            }));
        }
}}

export {
    addCajuelaSemana,
    obtenerCajuelaSemana
}



