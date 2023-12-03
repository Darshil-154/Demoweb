
<?php include_once 'top.php';?>
<script  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="text.js"></script>
<style>
  body{
    background-color: black;
    color: white;
  }
.text{
  animation: color-animation 2s linear infinite;
}

.a{
  --color-1: #DF8453;
  --color-2: #3D8DAE;
  --color-3: #E4A9A8;
}

.b{
  --color-1: #DBAD4A;
  --color-2: #ACCFCB;
  --color-3: #17494D;
}

.c{
  --color-1: #ACCFCB;
  --color-2: #E4A9A8;
  --color-3: #ACCFCB;
}
.d{
  --color-1: #3D8DAE;
  --color-2: #DF8453;
  --color-3: #E4A9A8;
}


@keyframes color-animation {
  0%    {color: var(--color-1)}
  32%   {color: var(--color-1)}
  33%   {color: var(--color-2)}
  65%   {color: var(--color-2)}
  66%   {color: var(--color-3)}
  99%   {color: var(--color-3)}
  100%  {color: var(--color-1)}
}

/* Here are just some visual styles. 🖌 */

.bg{
  display: grid;
  place-items: center;  
  text-align: center;
  height: 100vh;
  margin-top: -84px;
}

.body{
  font-family: "Montserrat", sans-serif;
  font-weight: 800;
  font-size: 30px;
}
.word{
  color: #ACCFCB;

}

</style>

      <div class="bg">
        
        <div class="body">
          <span class="text a" style="margin-top: 30px;">I </span> 
          <span class="text b" style="margin-top: 30px;">AM </span> 
          <span class="text c" style="margin-top: 30px;">Darshil </span> 
          <br>
<span class="text d" id="a">This website is made in</span>
          <div class="word"></div>
          
        </div>
        
      </div>
      <?php include 'logout.php'?>
      <?php include 'footer.php'?>