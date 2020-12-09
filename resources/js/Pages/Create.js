import React, {useState} from 'react'
import Front from '../Layouts/Front'
import {Inertia} from '@inertiajs/inertia'

const create = ({errors}) => {
    const [values, setValues] = useState({
        name: '',
        email:'',
        password: '',
        password_confirmation: '',
    })
    function handleChange(e){
        e.persist();
        setValues(values => ({...values, [e.target.id]: e.target.value}));
    }
    function handleSubmit(e){
        e.preventDefault();
        const formData = new FormData();
        formData.append('name', values.name);
        formData.append('email', values.email);
        formData.append('password', values.password);
        formData.append('password_confirmation', values.password_confirmation);
        Inertia.post('https://a97a379064df.ngrok.io/user', formData);
        // Inertia.post('https://a97a379064df.ngrok.io/user', values);
    }
    return (
        <Front>
            <div className="row">
                <div className="col-md-6 offset-md-3">
                    <form onSubmit={handleSubmit} method="post" encType="multipart/form-data">
                        <div className="form-group">
                            <label  htmlFor="inputName" className="col-sm-1-12 col-form-label">Name</label>
                            <div className="col-sm-1-12">
                                <input type="text" className="form-control" name="name" id="name" placeholder="Name" value={values.name} onChange={handleChange} />
                                {errors.name && <small className="alert alert-danger">{errors.name}</small>}
                            </div>
                        </div>
                        <div className="form-group">
                            <label  htmlFor="email" className="col-sm-1-12 col-form-label">Email</label>
                            <div className="col-sm-1-12">
                                <input type="text" className="form-control" name="email" id="email" placeholder="Email" value={values.email} onChange={handleChange}  />
                                {errors.email && <small className="alert alert-danger">{errors.email}</small>}
                            </div>
                        </div>
                        <div className="form-group">
                            <label  htmlFor="password" className="col-sm-1-12 col-form-label">Password</label>
                            <div className="col-sm-1-12">
                                <input type="password" className="form-control" name="password" id="password" placeholder="Password"  value={values.password} onChange={handleChange}  />
                                {errors.password && <small className="alert alert-danger">{errors.password}</small>}
                            </div>
                        </div>
                        <div className="form-group">
                            <label  htmlFor="password_confirmation" className="col-sm-1-12 col-form-label">Retype Password</label>
                            <div className="col-sm-1-12">
                                <input type="password" className="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password"  value={values.password_confirmation} onChange={handleChange}  />
                                {errors.password_confirmation && <small className="alert alert-danger">{errors.password_confirmation}</small>}
                            </div>
                        </div>
                        <div className="form-group">
                            <div className="offset-sm-2 col-sm-10">
                                <button type="submit" className="btn btn-primary">Register</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </Front>
    )
}

export default create
