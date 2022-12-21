import React from 'react'
import { Link } from 'react-router-dom'

export const HomePage = () => {
  return (
    <div>

      <Link to={'/agregar-cajuelas'}>AgregarCajuelas</Link><br/>
    </div>
  )
}
