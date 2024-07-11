
import React from 'react'
import './footer.css'
import { assets } from '../../assets/assets'

const Footer = () => {
    return (
        <>
        <div className="footer" id='footer'>
            <div className="footer-content">
                <div className="footer-content-left">
                    <img src={assets.logo} alt="" className="footer-logo"/>
                    <p>Discover a world of culinary delights delivered straight to your door. TastyTrails brings you the freshest, most delectable dishes from your favorite local eateries. From comfort food to gourmet meals, our curated selection ensures every bite is a new adventure. Join us on a journey of taste and enjoy hassle-free delivery, exceptional service, and the joy of dining in the comfort of your home.</p>
                    <div className="footer-social-icons">
                        <img src={assets.facebook_icon} alt="" />
                        <img src={assets.twitter_icon} alt="" />
                        <img src={assets.linkedin_icon} alt="" />
                    </div>
                </div>
                <div className="footer-content-center">
                    <h2>COMPANY</h2>
                    <ul>
                        <li>Home</li>
                        <li>About Us</li>
                        <li>Delivery</li>
                        <li>Privacy Policy</li>
                        
                    </ul>
                    
                </div>
                <div className="footer-content-right">
                    <h2>GET IN TOUCH</h2>
                    <ul>
                        <li>0750104549</li>
                        <li>tasty.info.trails@gamil.com</li>
                    </ul>
                </div>
            </div>
            <hr/>
            <p className="footer-copyright">
                Copyright 2024 TastyTrails.com - All Right Reserved.        
            </p>

        </div>
        </>
    )
}

export default Footer
