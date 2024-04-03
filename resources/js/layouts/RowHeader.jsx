import React from 'react';
import { SearchBar } from '../components/SearchBar'
export const RowHeader = ({ }) => {

    return (
        <div className="row header">
            <div className="col-sm-6 col-4 text-center text-light">
                <h1 className='tiluloprincipal'>Meteo map<img id="imgTitl" src='img/radar.png' width={"70px"} /></h1>

            </div>
            <div className="col-sm-3 col-8">
                <SearchBar />
            </div>
            <div className="col-sm-3 d-none d-sm-block "></div>
        </div >
    );
}