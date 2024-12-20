<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Account</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }
    .main {
        margin-bottom: 10px;
    }

    .title {
        font-size: 36px;
        margin-bottom: 20px;
        text-align: center;
        color: #AB7749;
    }
    
    .form-container {
        background-color: white;
        padding: 20px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 400px;
        height: 550px;
    }
    
    h1 {
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
    }
    
    p {
        font-size: 14px;
        text-align: center;
        margin-bottom: 20px;
    }
    
    .input-group {
        margin-bottom: 15px;
    }
    
    .input-group input, .input-group select {
        width: 95%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    
    .birthday, .gender-options {
        display: flex;
        justify-content: space-between;
        padding: 0px;
    }
    
    .gender-options label {
        flex: 1;
        text-align: center;
    }
    
    .gender-options input {
        margin-right: 5px;
    }
    
    .btn {
        width: 100%;
        padding: 10px;
        background-color: #42b72a;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }
    
    .btn:hover {
        background-color: #36a420;
    }
    
    .terms, .login-link {
        text-align: center;
        font-size: 12px;
    }
    
    .login-link a, .terms a {
        color: #1877f2;
        text-decoration: none;
    }
    
    .login-link a:hover, .terms a:hover {
        text-decoration: underline;
    }
</style> 

</head>
<body>
    <main>
    <h1 class="title">Alchemy Bakery</h1>
    <div class="form-container">
        <h1>Create a new account</h1>
        <form>
            <div class="input-group">
                <input type="text" placeholder="First name" required>
                <input type="text" placeholder="Last name" required>
            </div>
            <div class="input-group">
                <label for="birthday">Birthday </label>
                <div class="birthday">
                    <select name="month" id="month">
                        <option value="month" selected>Month</option>
                        <option value="Jan">Jan</option>
                        <option value="Feb">Feb</option>
                        <option value="Mar">Mar</option>
                        <option value="Apr">Apr</option>
                        <option value="May">May</option>
                        <option value="Jun">Jun</option>
                        <option value="Jul">Jul</option>
                        <option value="Aug">Aug</option>
                        <option value="Sep">Sep</option>
                        <option value="Oct">Oct</option>
                        <option value="Nov">Nov</option>
                        <option value="Dec">Dec</option>
                    </select>
                    <select name="day" id="day">
                        <option value="day" selected>Day</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                        <option value="13">13</option>
                        <option value="14">14</option>
                        <option value="15">15</option>
                        <option value="16">16</option>
                        <option value="17">17</option>
                        <option value="18">18</option>
                        <option value="19">19</option>
                        <option value="20">20</option>
                        <option value="21">21</option>
                        <option value="22">22</option>
                        <option value="23">23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>        
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>

                    <select name="year" id="year">
                        <option value="year" selected>Year</option>
                        <option value="1990">1990</option>
                        <option value="1991">1991</option>
                        <option value="1992">1992</option>
                        <option value="1993">1993</option>
                        <option value="1994">1994</option>
                        <option value="1995">1995</option>
                        <option value="1996">1996</option>
                        <option value="1997">1997</option>
                        <option value="1998">1998</option>
                        <option value="1999">1999</option>
                        <option value="2000">2000</option>
                        <option value="2001">2001</option>
                        <option value="2002">2002</option>
                        <option value="2003">2003</option>
                        <option value="2004">2004</option>
                        <option value="2005">2005</option>
                        <option value="2006">2006</option>
                        <option value="2007">2007</option>
                        <option value="2008">2008</option>
                        <option value="2009">2009</option>
                        <option value="2010">2010</option>
                        <option value="2011">2011</option>
                        <option value="2012">2012</option>
                        <option value="2013">2013</option>
                        <option value="2014">2014</option>
                        <option value="2015">2015</option>
                        <option value="2016">2016</option>
                        <option value="2017">2017</option>
                        <option value="2018">2018</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <label for="gender">Gender</label>
                <div class="gender-options">
                    <label><input type="radio" name="gender" value="Female"> Female</label>
                    <label><input type="radio" name="gender" value="Male"> Male</label>
                    <label><input type="radio" name="gender" value="Custom"> Custom</label>
                </div>
            </div>
            <div class="input-group">
                <input type="email" placeholder="Mobile number or email" required>
                <input type="password" placeholder="New password" required>
            </div>
            <p class="terms">By clicking Sign Up, you agree to our <a href="#">Terms</a>, <a href="#">Privacy Policy</a>, and <a href="#">Cookies Policy</a>.</p>
            <button type="submit" class="btn">Sign Up</button>
            <p class="login-link"><a href="loginpage.php">Already have an account?</a></p>
        </form>
    </div>
</main>
</body>
</html>