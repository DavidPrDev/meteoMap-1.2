import React, { useState } from 'react';
import { motion, AnimatePresence } from 'framer-motion';
import '../../css/Modal.css'

export const Modal = ({ isVisible, setIsVisible, data, nombre }) => {
    console.log(data);
    const handleButtonClick = () => {
        setIsVisible(!isVisible);

    };

    return (
        <>
            <AnimatePresence>
                {isVisible && (
                    <motion.div
                        key="modalOverlay"
                        initial={{ opacity: 0 }}
                        animate={{ opacity: 1 }}
                        exit={{ opacity: 0 }}
                        transition={{ duration: 0.3 }}
                        className="modalOverlay"
                    >
                        <motion.div
                            initial={{ opacity: 0, y: "-50%" }}
                            animate={{ opacity: 1, y: "-80%" }}
                            exit={{ opacity: 0, y: "-50%" }}
                            transition={{ duration: 0.3, type: "spring", damping: 9, stiffness: 100 }}
                            className='modalCustom'
                        >
                            <div className='row'>
                                <div className='col colmodal text-light'>
                                    <h3 className='text-center idModal'>{nombre}</h3>

                                    {data && (
                                        <>
                                            <table className=" table table-dark">
                                                <thead>
                                                    <tr>
                                                        <th>Periodo</th>
                                                        <td></td>
                                                        <th scope="col">00h/12h</th>
                                                        <th scope="col">12h/24h</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <th>Estado del cielo</th>
                                                        <td></td>
                                                        <td ><img src={"img/" + data["icono12"] + ".png"} width='32px' /></td>
                                                        <td><img src={"img/" + data["icono24"] + ".png"} width="32px" /></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Prob lluvia</th>
                                                        <td></td>
                                                        <td> {data["probLl12"]}%</td>
                                                        <td>{data["probLl24"]}%</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Temperatura</th>
                                                        <td></td>
                                                        <td>Max : {data["tempMax"]}°C</td>
                                                        <td>Min : {data["tempMin"]}°C</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </>
                                    )}
                                    <button className='btn btn-danger btnclose ' onClick={handleButtonClick}>Cerrar</button>

                                </div>
                            </div>

                        </motion.div>
                    </motion.div>
                )}
            </AnimatePresence>
        </>
    )
}