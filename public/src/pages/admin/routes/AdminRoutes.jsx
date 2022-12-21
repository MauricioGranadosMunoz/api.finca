import { Route, Routes } from 'react-router-dom'
import { AddCajuelas } from '../AddCajuelas'
import { HomePage } from '../HomePage'

export const AdminRoutes = () => {
  return (
    <>
        <Routes>
            <Route path='/' element={ <HomePage/> }/>
            <Route path='/agregar-cajuelas' element={ <AddCajuelas/> }/>
            {/* <Route path='/users' element={ <UserAdminPage/> }/> */}
        </Routes>
    </>
  )
}
