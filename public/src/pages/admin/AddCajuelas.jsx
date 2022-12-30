import React, { useMemo, useState } from "react";
import { useEffect } from "react";
import { useDispatch, useSelector } from "react-redux";
import { useForm } from "../../hooks/useForm";
import {
  obtenerCajuelaSemana,
  obtenerPrecioActualCajuela,
  updateCajuelaPrecio,
} from "../../store/slices/Cajuela";
import {
  obtenerRebajaSemana,
  obtenerTrabajadoresActuales,
} from "../../store/slices/Usuario/usuarioThunk";
import { CheckingAuth } from "../auth/CheckingAuth";
import { DinamicCajuelasForm } from "../components/DinamicCajuelasForm";
import { MainLayout } from "../layout/MainLayout";

export const AddCajuelas = () => {
  const dispatch = useDispatch();
  const { PRECIO_CAJUELA, onInputChange, formState } = useForm({
    PRECIO_CAJUELA: 0,
  });

  useEffect(() => {
    dispatch(obtenerPrecioActualCajuela());
  }, []);

  const { usuario } = useSelector((state) => state.usuario);
  const { cajuelaSemana, cajuelasLoading, precioActual } = useSelector(
    (state) => state.cajuela
  );

  if (cajuelasLoading) {
    dispatch(obtenerCajuelaSemana(usuario.TOKEN));
    return <CheckingAuth />;
  }

  const updatePrecioCajuela = (e) => {
    e.preventDefault();
    dispatch(updateCajuelaPrecio(formState, usuario.TOKEN));
  };

  return (
    <MainLayout hasHeader>
      <h2 className="text-4xl font-extrabold dark:text-white mb-5 color-purple">
        Precio Actual:{" "}
        <span className="text-blue-600 dark:text-blue-500">
          ₡{precioActual}
        </span>
      </h2>
      <div>
        {
          <DinamicCajuelasForm
            cajuelaSemana={cajuelaSemana}
            precioActual={precioActual}
          />
        }
        <br />
      </div>
    </MainLayout>
  );
};
