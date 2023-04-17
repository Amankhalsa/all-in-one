<!DOCTYPE html>
<html lang="en">
    <head>
   <style>
        @page {  margin: 100px 25px; }
        header { position: fixed; top: -60px; left: 0px; right: 0px;   height: 50px; font-size: 20px !important; background-color: #000; color: white;text-align: center;line-height: 35px; }
        footer { position: fixed;  bottom: -60px;  left: 0px;    right: 0px; height: 50px;   font-size: 20px !important;  background-color: #000; color: white; text-align: center; line-height: 35px; }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
            {{$title}}
        </header>
        <footer>
            Copyright © <?php echo date("Y");?> -Lorem Ipsum is simply.com
        </footer>
        <main>
            <h3>What is Lorem Ipsum?</h3>
            <p style="page-break-after: always;">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                 Lorem Ipsum has been the industry's standard dummy text ever since the 
                  1500s, when an unknown printer took a galley of type and scrambled it to 
                   make a type specimen book. It has survived not only five centuries, but 
                    also the leap into electronic 
            </p>
            <h3>Where does it come from?</h3>
            <p style="page-break-after: never;">            
                Contrary to popular belief, Lorem Ipsum is not simply random text. It has 
                 roots in a piece of classical Latin literature from 45 BC, making it over 
                  2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney 
                   College in Virginia, looked up one of the more obscure Latin words, 
                    consectetur, from a Lorem Ipsum passage, and going through the cites of 
                     the word in classical literature, discovered the undoubtable source.
            </p>
        </main>
    </body>
</html>