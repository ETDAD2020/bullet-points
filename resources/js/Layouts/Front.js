import React, { Children } from 'react'
import Navbar from '../components/Navbar'

const Front = ({children}) => {
    return (
        <React.Fragment>
            <Navbar />
            <main className="container">
                {children}
            </main>
        </React.Fragment>
    )
}

export default Front
