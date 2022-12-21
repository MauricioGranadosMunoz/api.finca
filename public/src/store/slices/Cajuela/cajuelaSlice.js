import { createSlice } from '@reduxjs/toolkit';

export const cajuelaSlice = createSlice({
  name: 'cajuela',
  initialState: {
    cajuelaSemana: [],
    cajuelasLoading: true,
    cajuelasError: false
  },
  reducers: {
    setCajuelasSemana: ( state, action ) => {
      state.cajuelaSemana = action.payload.cajuelaSemana;
      state.cajuelasLoading = false;
    },
    setCajuelasError: ( state ) => {
          state.cajuelasError = true;
          state.cajuelasLoading = false;
    } 
  }
});

export const { setCajuelasSemana, setCajuelasError } = cajuelaSlice.actions;