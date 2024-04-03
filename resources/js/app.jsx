import './bootstrap';
import '../css/app.css';

import React from 'react';
import ReactDOM from 'react-dom/client';

import 'bootstrap/dist/css/bootstrap.min.css'

import { Row12 } from './layouts/Row12'
import { Mapa } from './components/Mapa'
import { RowHeader } from './layouts/RowHeader'


ReactDOM.createRoot(document.getElementById('app')).render(

    <div className='container-fluid'>
        <RowHeader />
        <Row12
            titulo={<Mapa />}
            customClass="center" />
        <Row12
            titulo="Conectada a la api de AEMET "
            customClass="footer fixed-bottom text-light" />
    </div>

);