import React, { useRef, useState, useEffect } from 'react';
import { Modal } from './Modal'
import { Search } from 'react-bootstrap-icons';
import { autocomplete, getMunicipio } from '../services/MapaService';
import '../../css/SearchBar.css'

export const SearchBar = () => {
    const [inputValue, setInputValue] = useState('');
    const [suggestions, setSuggestions] = useState([]);
    const [isVisible, setIsVisible] = useState(false);
    const [tableDisplayStyle, setTableDisplayStyle] = useState('none');
    const [data, setData] = useState(null);
    const [nombre, setNombre] = useState(null);
    const [showSpinner, setShowSpinner] = useState(false);
    const [zIndex, setZIndex] = useState(1);
    const inputRef = useRef(null);

    const clickSearch = () => {
        const tdElement = document.querySelector('td');
        if (inputValue == "") {
            inputRef.current.blur();
            setData("");
            setNombre("Introducce un Municipio ")
            setIsVisible(true);

        }

        if (tdElement == null && inputValue != "") {
            inputRef.current.blur();
            setData("");
            setNombre("Municipio no encontrado")
            setIsVisible(true);

        } else {
            checkTableContent();
        }
    };

    const keySearch = (event) => {
        const tdElement = document.querySelector('td');
        if (event.key === 'Enter') {

            if (inputValue == "") {
                inputRef.current.blur();
                setData("");
                setNombre("Introducce un Municipio ")
                setIsVisible(true);

            }

            if (tdElement == null && inputValue != "") {
                inputRef.current.blur();
                setData("");
                setNombre("Municipio no encontrado")
                setIsVisible(true);
            }
            else {
                checkTableContent();
            }

        } else if (event.key === ' ' && event.target === document.activeElement) {

            event.preventDefault();
            const newInputValue = inputValue + ' ';
            setInputValue(newInputValue);
        }
    };
    const removeAccents = (str) => {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    };
    const handleInputChange = (event) => {
        const newInputValue = event.target.value.trim();
        setInputValue(newInputValue);
    };
    const hiddeDiv = () => {
        setTimeout(() => {
            setInputValue('');
        }, 300);

    }
    const checkTableContent = () => {
        const table = document.getElementById('suggestions-list');
        setZIndex(99);
        if (!table) {
            setZIndex(0);
            setData("");
            setNombre("Introduce un Municipio ")
            setIsVisible(true);
            return;
        }

        const rows = table.getElementsByTagName('tr');

        for (let i = 0; i < rows.length; i++) {

            const cells = rows[i].getElementsByTagName('td');

            for (let j = 0; j < cells.length; j++) {
                const cellContent = cells[j].innerText;
                const value = cells[j].getAttribute('data-codigo');
                if (removeAccents(cellContent.toLowerCase()) == removeAccents(inputValue.toLowerCase())) {
                    obtenerParte(value, cellContent);
                } else {

                    setData("");
                    setNombre("Municipio Invalido")
                    setIsVisible(true);
                }
            }
        }
    };
    const obtenerParte = async (value, cellContent) => {

        setShowSpinner(true);
        try {

            const response = await getMunicipio(value);

            setData(response);
            setNombre(cellContent)
            setIsVisible(true);


        } catch (error) {
            console.error('Error al realizar la solicitud:', error);
        } finally {
            setShowSpinner(false);
        }
    }
    useEffect(() => {
        const fetchSuggestions = async () => {

            setShowSpinner(true);
            try {
                if (inputValue.trim() !== '') {
                    const response = await autocomplete(inputValue);

                    setZIndex(99);
                    setSuggestions(response);
                    setTableDisplayStyle('block');

                } else {

                    setZIndex(0);
                    setSuggestions([]);
                    setTableDisplayStyle('none');


                }
            } catch (error) {
                console.error('Error al realizar la solicitud:', error);
            } finally {
                setShowSpinner(false);
            }
        };

        fetchSuggestions();
    }, [inputValue]);


    return (
        <div id="containerli" onBlur={hiddeDiv}>
            {showSpinner && (
                <div className=" spinerSearch spinner-border text-primary" role="status">
                    <span className="visually-hidden">Loading...</span>
                </div>
            )}
            <div className="input-group mt-3">
                <input className='form-control'
                    type="text"
                    id="autocomplete"
                    placeholder='El tiempo en ...'
                    value={inputValue}
                    onChange={handleInputChange}
                    onKeyDown={keySearch} aria-describedby="butnSearch"
                    ref={inputRef} />
                <button onClick={clickSearch} tabIndex="0" className="btn btn-outline-primary" type="button" id="butnSearch">
                    <Search size="20px" />
                </button>

            </div>

            <div style={{ zIndex: zIndex }} className='table-wrapper-scroll-y my-custom-scrollbar'>
                <table className="table table-hover " id="suggestions-list" >
                    <thead></thead>
                    <tbody id="tBody">
                        {suggestions.map((municipio) => (
                            <tr key={municipio.codigo} >
                                <td onClick={() => obtenerParte(municipio.codigo, municipio.nombre)} data-codigo={municipio.codigo}>
                                    {municipio.nombre}
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>

            <Modal isVisible={isVisible} setIsVisible={setIsVisible} data={data} nombre={nombre} />
        </div>

    );
};
