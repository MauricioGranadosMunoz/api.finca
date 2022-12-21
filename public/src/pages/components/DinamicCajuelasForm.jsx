import React, { useState } from 'react'
import { useDispatch, useSelector } from 'react-redux';
import { addCajuelaSemana } from '../../store/slices/Cajuela';

export const DinamicCajuelasForm = ({ cajuelaSemana }) => {
  
  const dispatch = useDispatch();

const { usuario } = useSelector( state => state.usuario );


const [formFields, setFormFields] = useState(JSON.parse(cajuelaSemana.CAJUELAS_JSON_SEMANA));
  
const handleFormChange = (e, index) => {
  const data = [...formFields];
  const result = e.target.value.replace(/[^0-9\.]/g, '');
  data[index][e.target.name] = result;

  const arr = Object.values(data[index]);
  arr.pop();
  const sumWithInitial =  arr.reduce((accumulator, currentValue) => accumulator + Number(currentValue), 0);
  
  data[index]['total'] = sumWithInitial;
  
  setFormFields(data);
  dispatch(addCajuelaSemana(formFields, usuario));
}

const submit = (e) => {
  e.preventDefault();
  dispatch(addCajuelaSemana(formFields, usuario));
}

  return (
    <form onSubmit={ submit } autoComplete="off">
    {formFields.map((form, index) => {
      return (
        <div key={index} className='cajuelas-groupe'>
          {/* <p>{trabajadores[index].TRABAJADOR_ID}</p> */}
            <div className='cajuelas-item'>
              <label>
                Lunes
                <input
                name='lunes'
                placeholder='lunes'
                onChange={event => handleFormChange(event, index)}
                value={form.lunes}
                />
              </label>
            </div>
            <div className='cajuelas-item'>
              <label>
                Martes
                <input
                name='martes'
                placeholder='martes'
                onChange={event => handleFormChange(event, index)}
                value={form.martes}
                />
              </label>
            </div>
            <div className='cajuelas-item'>
              <label>
                Miercoles
                <input
                name='miercoles'
                placeholder='miercoles'
                onChange={event => handleFormChange(event, index)}
                value={form.miercoles}
                />
              </label>
            </div>
            <div className='cajuelas-item'>
              <label>
                Jueves
                <input
                name='jueves'
                placeholder='jueves'
                onChange={event => handleFormChange(event, index)}
                value={form.jueves}
                />
              </label>
            </div>
            <div className='cajuelas-item'>
              <label>
                Viernes
                <input
                name='viernes'
                placeholder='viernes'
                onChange={event => handleFormChange(event, index)}
                value={form.viernes}
                />
              </label>
            </div>
            <div className='cajuelas-item'>
              <label>
                Sabado
                <input
                name='sabado'
                placeholder='sabado'
                onChange={event => handleFormChange(event, index)}
                value={form.sabado}
                />
              </label>
            </div>
            <div className='cajuelas-item'>
              <label>
                Total Cajuelas
                <input
                name='total'
                placeholder='total'
                onChange={event => handleFormChange(event, index)}
                value={form.total}
                disabled
                />
              </label>
            </div>
        </div>
      )
    })}
    <button onClick={submit}>Guardar Semana</button>
  </form>
  )
}
