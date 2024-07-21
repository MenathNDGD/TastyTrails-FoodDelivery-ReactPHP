import React, { useState } from 'react';
import './LoginPopup.css';
import { assets } from '../../assets/assets';

const LoginPopup = ({ setShowLogin }) => {
  const [currState, setCurrState] = useState("Sign Up");
  const [errorMessage, setErrorMessage] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    const name = currState === "Sign Up" ? e.target[0].value : null;
    const email = e.target[currState === "Sign Up" ? 1 : 0].value;
    const password = e.target[currState === "Sign Up" ? 2 : 1].value;

    const body = {
      uid: email,
      email,
      pwd: password,
      name,
    };

    try {
      const response = await fetch(`http://localhost/Tasty_Trails/PHP/signup.php`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: new URLSearchParams(body),
      });

      const data = await response.json();

      if (data.error) {
        setErrorMessage(data.error.join(', '));
      } else {
        setErrorMessage('');
        console.log(data.message);
        // Handle success (e.g., show a success message or redirect)
      }
    } catch (error) {
      setErrorMessage('An error occurred. Please try again.');
    }
  };

  return (
    <div className='login-popup'>
      <form className="login-popup-container" onSubmit={handleSubmit}>
        <div className="login-popup-title">
          <h2>{currState}</h2>
          <img onClick={() => setShowLogin(false)} src={assets.cross_icon} alt="Close" />
        </div>
        <div className="login-popup-inputs">
          {currState === "Login" ? null : <input type="text" placeholder='Your name' required />}
          <input type="email" placeholder='Your email' required />
          <input type="password" placeholder='Password' required />
        </div>
        <button type="submit">{currState === "Sign Up" ? "Create Account" : "Login"}</button>
        <div className="login-popup-condition">
          <input type="checkbox" required />
          <p>By continuing, I agree to the terms of use and privacy policy.</p>
        </div>
        {errorMessage && <p className="error-message">{errorMessage}</p>}
        <p>Create a new Account? <span onClick={() => setCurrState("Sign Up")}>Click Here</span></p>
        <p>Already have an Account? <span onClick={() => setCurrState("Login")}>Login Here</span></p>
      </form>
    </div>
  );
};

export default LoginPopup;
