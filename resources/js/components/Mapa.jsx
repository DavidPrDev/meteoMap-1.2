import React, { useState, useEffect } from 'react';
import { Modal } from './Modal'
import { motion } from "framer-motion";
import Tooltip from "react-bootstrap/Tooltip";
import OverlayTrigger from "react-bootstrap/OverlayTrigger";
import { getComunidades, getMunicipio } from '../services/MapaService';

import '../../css/Mapa.css'

const hoverEffectVariants = {
    hover: {
        scale: 1.1,
        y: -8,
        transition: {
            duration: 0.1, type: "spring", damping: 12, stiffness: 309
        }
    },
};
export const Mapa = () => {
    const [data, setData] = useState(null);
    const [nombre, setNombre] = useState(null);
    const [isVisible, setIsVisible] = useState(false);
    const [iconos, setIconos] = useState([]);
    const [showSpinner, setShowSpinner] = useState(false);

    useEffect(() => {
        const obtenerIconos = async () => {
            setShowSpinner(true);
            try {
                const data = await getComunidades();

                setIconos(data);

            } catch (error) {
                console.error('Error al obtener iconos:', error);
            } finally {
                setShowSpinner(false);
            }
        };

        obtenerIconos();
    }, []);

    const handleIconClick = async (codigo, nombre) => {

        setShowSpinner(true);

        try {

            const response = await getMunicipio(codigo);
            setData(response);
            setNombre(nombre)
            setIsVisible(true);


        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
        } finally {
            setShowSpinner(false);
        }
    };

    return (
        <>
            <div className="row">
                <div className="col-sm-4 col-1 " ></div>

                <div className="col-sm-6 col-12">
                    <div className="container-map">
                        {showSpinner && (
                            <div className="spinnerMap spinner-border text-primary" role="status">
                                <span className="visually-hidden">Loading...</span>
                            </div>
                        )}
                        {iconos.map((icono, index) => (

                            <span className='spanIcono' key={index}

                                onClick={() => handleIconClick(icono.Codigo, icono.Nombre)}>
                                <OverlayTrigger placement="top" overlay={<Tooltip >{icono.Nombre == "Iruna" ? "Pamplona" : icono.Nombre}</Tooltip>}>
                                    <motion.img
                                        variants={hoverEffectVariants} whileHover="hover"
                                        src={"img/" + icono.estadoCielo + ".png"}
                                        className="iconosLejanos iconos"
                                        id={icono.Nombre}
                                    />
                                </OverlayTrigger>
                            </span>


                        ))}

                    </div>

                </div>

                <div className="col-sm-2 d-none d-sm-block " ></div>

            </div>
            <Modal isVisible={isVisible} setIsVisible={setIsVisible} data={data} nombre={nombre} />
        </>
    );
}