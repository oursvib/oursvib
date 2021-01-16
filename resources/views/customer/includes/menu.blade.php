<nav id="navigation" class="style-1">
    <ul id="responsive">
        <li><a class="current" href="#">Home</a></li>
        <li> 
            <select name="countrylist" id="countrylist" class="countrylist"  >    
            <?php foreach($countries as $country){?>
            <option value="<?php echo $country->countryId; ?>" <?php if($country->countryId==Session::get('countryid')){?> selected="selected" <?php } ?>> <?php echo ucwords($country->name); ?> </option>
            <?php } ?>  
            </select>
        </li>

    </ul>  
</nav>
