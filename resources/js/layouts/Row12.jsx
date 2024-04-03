import React from 'react';

export const Row12 = ({ titulo, customClass, withH1 = false }) => {
    const custClass = customClass == null ? "" : `${customClass}`;
    const content = withH1 ? <h1>{titulo}</h1> : <>{titulo}</>;

    return (
        <div className={`row ${custClass}`}>
            <div className="col-12 ">
                {content}

            </div>
        </div>
    );
}