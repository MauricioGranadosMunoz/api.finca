import { Navigate, useNavigate } from 'react-router-dom';
import { useSelector } from 'react-redux';
import { useCheckAuth } from '../hooks/useCheckAuth';
import { useEffect } from 'react';
import { CheckingAuth } from '../pages/auth/CheckingAuth';

export const PrivateRoute = ({ children }) => {
    const status = useCheckAuth();

    if (status === 'checking') {
      return <CheckingAuth/>
    }

    return (status)
    ? children
    : <Navigate to='/login'/>

}
