import React from 'react'
import {InertiaLink} from '@inertiajs/inertia-react'

const Navbar = (props) => {
    const {url} = history.state
    return (
            <nav className="navbar navbar-expand-sm navbar-dark bg-dark">
                <InertiaLink className="navbar-brand" href="#">Navbar</InertiaLink>
                <button className="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
                    <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="collapsibleNavId">
                    <ul className="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li className={url == '/' ? 'nav-item active' : 'nav-item'}>
                            <InertiaLink className="nav-link" href="https://app.storeks.com/">Home</InertiaLink>
                        </li>
                        <li className={url == '/user' ? 'nav-item active' : 'nav-item'}>
                            <InertiaLink className="nav-link" href="https://app.storeks.com/user">Users</InertiaLink>
                        </li>
                        <li className={url == '/user/create' ? 'nav-item active' : 'nav-item'}>
                            <InertiaLink className="nav-link" href="https://app.storeks.com/user/create">Add Users</InertiaLink>
                        </li>
                    </ul>
                </div>
            </nav>
    )
}

export default Navbar
