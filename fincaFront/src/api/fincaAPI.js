import axios from 'axios';

export const usuarioApi = axios.create({
    baseURL: 'http://localhost/FincaBackEnd/v1/usuarios'
})
export const cajuelaApi = axios.create({
    baseURL: 'http://localhost/FincaBackEnd/v1/cajuelas'
})