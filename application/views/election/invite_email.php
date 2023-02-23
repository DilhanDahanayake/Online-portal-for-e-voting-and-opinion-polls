<div class="ww3-center">
    <h1>
        Send Invites via Email (POLL - <?php echo $election[0]['name']; ?>)
    </h1>
</div>
<br>

<div class="ww3-center">
    <h3>
        Send Invites To All
    </h3>
</div>
<form action="/election/send_invite/all/<?php echo $election[0]['id']; ?>" class="w3-padding">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Send To All" />
</form>
<br>
<br>
<div class="ww3-center">
    <h3>
        Send Invites By City
    </h3>
</div>
<form action="/election/send_invite/city/<?php echo $election[0]['id']; ?>" class="w3-padding" method="post">

    <select name="city" id="city">
        <?php foreach($city as $i){ ?>
        <option value="<?php echo $i['city']; ?>"><?php echo $i['city']; ?></option>
        <?php } ?>
    </select>
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Send To Selected City" />
</form>
<br>
<br>

<div class="ww3-center">
    <h3>
        Send Invites By Income Level
    </h3>
</div>
<form action="/election/send_invite/il1/<?php echo $election[0]['id']; ?>" class="w3-padding-16" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Income Level - Rs 0 - 50 000" />
</form>
<form action="/election/send_invite/il2/<?php echo $election[0]['id']; ?>" class="w3-padding-16" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Income Level - Rs 50 000 - 100 000" />
</form>
<form action="/election/send_invite/il3/<?php echo $election[0]['id']; ?>" class="w3-padding-16" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Income Level - Rs 100 000 - 250 000" />
</form>
<form action="/election/send_invite/il4/<?php echo $election[0]['id']; ?>" class="w3-padding-16" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Income Level -Rs 250 000 Above" />
</form>
<br>
<br>

<div class="ww3-center">
    <h3>
        Send Invites By Education Level
    </h3>
</div>
<form action="/election/send_invite/ed1/<?php echo $election[0]['id']; ?>" class="w3-padding" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="OL" />
</form>
<form action="/election/send_invite/ed3/<?php echo $election[0]['id']; ?>" class="w3-padding" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="AL" />
</form>
<form action="/election/send_invite/ed2/<?php echo $election[0]['id']; ?>" class="w3-padding" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Graduate" />
</form>
<form action="/election/send_invite/ed4/<?php echo $election[0]['id']; ?>" class="w3-padding" method="post">
    <input class="w3-green w3-border-black w3-round-xlarge w3-button" type="submit" value="Post Graduate" />
</form>