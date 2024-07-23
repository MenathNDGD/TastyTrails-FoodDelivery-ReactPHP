import React, { useState } from 'react';
import { Route, Routes } from 'react-router-dom';
import Navbar from './components/Navbar/Navbar';
import Home from './pages/Home/Home';
import Cart from './pages/Cart/Cart';
import PlaceOrder from './pages/PlaceOrder/PlaceOrder';
import LoginPopup from './components/LoginPopup/LoginPopup'; 
import GoToTopButton from './components/GoToTopButton/GoToTopButton';
import Footer from './components/footer/footer';

const App = () => {
  const [showLogin, setShowLogin] = useState(false);

  return (
    <div>
      {showLogin && <LoginPopup setShowLogin={setShowLogin} />}
      <div className='app'>
        <Navbar setShowLogin={setShowLogin} />
        
        <Routes>
          <Route path='/' element={<Home />} />
          <Route path='/cart' element={<Cart />} />
          <Route path='/order' element={<PlaceOrder />} />
        </Routes>

        <GoToTopButton />
        
        <Footer />
      </div>
    </div>
  );
}

export default App;
