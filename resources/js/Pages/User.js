import React from 'react'
import Front from '../Layouts/Front'

const User = (users2)=> {
    console.log(users2.users);
    return (
        <Front>
            <div className="row d-block">
                {users2.users.map(user3 => <p key={user3.id}> {user3.name}</p>)}
            </div>
        </Front>
    )
}
export default User
