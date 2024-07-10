import React, { useState } from 'react'
import './loginPopup.css'
import { assets } from '../../assets/assets'

const loginPopup = ({setShowLogin}) => {

    const [currState,setCurrState] = useState("Sign Up")

  return (
    <div className='login-popup'>
        <form className="login-popup-container">
            <div className="login-popup-title">
                <h2>{currState}</h2>
                <img onClick={()=>setShowLogin(false)} src={assets.cross_icon} alt="" />
            </div>
            <div className="login-popup-inputs">
                {currState==="Login"?<></>:<input type="text" placeholder='Your name' required />}
                <input type="email" placeholder='Your email' required />
                <input type="password" placeholder='Password' required />
            </div>

            <p>Create a new Account? <span onClick={()=>setCurrState("Sign Up")}>Click Here</span></p>
            <p>Already have an Account? <span onClick={()=>setCurrState("Login")}>Login Here</span></p>
        </form>
        
    </div>
  )
}

export default loginPopup