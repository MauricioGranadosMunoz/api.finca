import { usuarioApi } from "../../../api/fincaAPI";
import { setLoadedToken, setTrabajadores, setUsuarioLogged } from "./usuarioSlice";

const loginUsuario = ({ US_CORREO , US_CONTRASENA  }) => {
    return async( dispatch, getState ) => {

        const { data } = await usuarioApi.post(
            `/userLogin.php`,
            {
                "EMAIL": US_CORREO,
                "CONTRASENA": US_CONTRASENA
        }
        )

        const { success, usuario } = data;

        if (success) {
            localStorage.setItem('fincaUserData', JSON.stringify(usuario) );
            success && dispatch(setUsuarioLogged({
                usuario: usuario
            }));
        }
}}

const checkValidUser = (usuario) => {
    return async( dispatch, getState ) => {
        const { data } = await usuarioApi.post('/isTokenValid.php',{},
        { 
            headers: {
                "Authorization" : `Bearer ${usuario.TOKEN}`
            }
        })
        
        if ( !data.status ) return false;
        dispatch(setLoadedToken({
            usuario
        }));
}}

const obtenerTrabajadoresActuales = (token) => {
    return async(dispatch, getState ) => {
        const { data } = await usuarioApi.post('/obtenerTrabajadoresActuales.php',{},
        { 
            headers: {
                "Authorization" : `Bearer ${token}`
            }
        })
        dispatch(setTrabajadores({
            trabajadores: data.TRABAJADORES
        }));
        
}}

export {
    loginUsuario,
    checkValidUser,
    obtenerTrabajadoresActuales
}



