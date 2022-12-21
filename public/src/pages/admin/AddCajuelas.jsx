import React, { useMemo, useState } from 'react'
import { useEffect } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { obtenerCajuelaSemana } from '../../store/slices/Cajuela';
import { obtenerTrabajadoresActuales } from '../../store/slices/Usuario/usuarioThunk';
import { CheckingAuth } from '../auth/CheckingAuth';
import { DinamicCajuelasForm } from '../components/DinamicCajuelasForm';
import { PDFViewer, PDFDownloadLink } from '@react-pdf/renderer';
import { MainPDF } from '../../pdf/MainPDF';

export const AddCajuelas = () => {
  const dispatch = useDispatch();

  const { usuario } = useSelector( state => state.usuario );
  const { cajuelaSemana, cajuelasLoading, cajuelasError } = useSelector( state => state.cajuela );
  
  useEffect(() => {
    dispatch(obtenerTrabajadoresActuales(usuario.TOKEN));
    
  }, [])

  if ( cajuelasLoading ) {
    dispatch(obtenerCajuelaSemana(usuario.TOKEN));
    return <CheckingAuth/> 
  }
  
  return (
    <div >
      {
        <DinamicCajuelasForm cajuelaSemana={ cajuelaSemana }/>
      }
      <br />
      <PDFDownloadLink document={<MainPDF />} fileName="somename.pdf">
      {({ blob, url, loading, error }) =>
        loading ? 'Loading document...' : 'Download now!'
      }
    </PDFDownloadLink>
    </div>
  )
}