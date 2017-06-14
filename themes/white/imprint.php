<!DOCTYPE html>
<html lang="de">
<?php 
include('include.php');
$pade = 1;
$result = $db->query("SELECT * FROM pages WHERE id = '$page'");
?>
<head>
  <title>at-Tawhid - <?php
  $title = $result->fetchArray();
  echo $title['title'];


  ?></title>
  <meta charset="UTF-8">
  <meta name="content-language" content="de" />
  <meta name="author"           content="Harry Machura" />
  <meta name="publisher"        content="Harry Machura" />
  <meta name="copyright"        content="at-Tawhid" />
  <meta name="keywords"         content="impressum, imprint, harry machura, Ilm-Database" />
  <meta name="description"      content="at-Tawhid Impressum" />
  <meta name="language"         content="Deutsch" />
  <meta property="og:title" content="at-Tawhid - Impressum"/>
  <meta property="og:description" content="Impressum von at-Tawhid.de"/>
  <meta property="og:image" content="http://at-tawhid.de/images/propertyimage/imprint.jpg"/>
  <?php $get_header(); ?>
</head>
<body>
<div class="rep_logo">
<img src="images/codeveloper.svg" alt="Logo" width="380" style="padding-top: 10px; padding-left: 50px;">
</div>
<form>
<input type="text" class="search" name="search" />
</form>
<script type="text/javascript">
  /* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
<div class="rep_nav">
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"></button>
  <div id="myDropdown" class="dropdown-content">
<?php
echo $navigation;
?>
  </div>
</div>
<form>
<input type="text" class="search_rep" name="search" />
</form>
</div>
<ul id="drop-nav">
<?php
echo $navigation;
?>
</ul>
<div class="wrapper">
<div class="site">

<?php
if (isset($_GET['search'])) {
  search($_GET['search']);
} else {
?>
<article>
<h2 style="text-align: center;">Impressum</h2>
<table style="font-size: 22px;">
<tr>
  <td><b>Harry Machura</b></td>
</tr>
  <tr>
    <td>Breithauptstraße 3</td>
  </tr>
    <tr>
    <td>34127 Kassel</td>
  </tr>
</table>
<p></p>
<b>Kontakt</b>
<table>
  <tr><td>Telefon:</td><td>0157 812 340 26</td></tr>
  <tr><td>E-Mail:</td><td>info@codeveloper.de</td></tr>
</table>
<p></p>
Quelle: <i>Impressumsgenerator, Rechtsanwalt für <a href="http://www.e-recht24.de/" target="_blank">Internetrecht</a> Sören Siebert</i>
<h3>Haftungsausschluss:</h3>
<b>Haftung für Inhalte</b>
<br><br>
Die Inhalte unserer Seiten wurden mit größter Sorgfalt erstellt. Für die Richtigkeit, Vollständigkeit und Aktualität der Inhalte können wir jedoch keine Gewähr übernehmen. Als Diensteanbieter sind wir gemäß § 7 Abs.1 TMG für eigene Inhalte auf diesen Seiten nach den allgemeinen Gesetzen verantwortlich. Nach §§ 8 bis 10 TMG sind wir als Diensteanbieter jedoch nicht verpflichtet, übermittelte oder gespeicherte fremde Informationen zu überwachen oder nach Umständen zu forschen, die auf eine rechtswidrige Tätigkeit hinweisen. Verpflichtungen zur Entfernung oder Sperrung der Nutzung von Informationen nach den allgemeinen Gesetzen bleiben hiervon unberührt. Eine diesbezügliche Haftung ist jedoch erst ab dem Zeitpunkt der Kenntnis einer konkreten Rechtsverletzung möglich. Bei Bekanntwerden von entsprechenden Rechtsverletzungen werden wir diese Inhalte umgehend entfernen.
<br><br>
<b>Haftung für Links</b><br><br>

Unser Angebot enthält Links zu externen Webseiten Dritter, auf deren Inhalte wir keinen Einfluss haben. Deshalb können wir für diese fremden Inhalte auch keine Gewähr übernehmen. Für die Inhalte der verlinkten Seiten ist stets der jeweilige Anbieter oder Betreiber der Seiten verantwortlich. Die verlinkten Seiten wurden zum Zeitpunkt der Verlinkung auf mögliche Rechtsverstöße überprüft. Rechtswidrige Inhalte waren zum Zeitpunkt der Verlinkung nicht erkennbar. Eine permanente inhaltliche Kontrolle der verlinkten Seiten ist jedoch ohne konkrete Anhaltspunkte einer Rechtsverletzung nicht zumutbar. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Links umgehend entfernen.
<br><br>
<b>Urheberrecht</b><br><br>

Die durch die Seitenbetreiber erstellten Inhalte und Werke auf diesen Seiten unterliegen dem deutschen Urheberrecht. Die Vervielfältigung, Bearbeitung, Verbreitung und jede Art der Verwertung außerhalb der Grenzen des Urheberrechtes bedürfen der schriftlichen Zustimmung des jeweiligen Autors bzw. Erstellers. Downloads und Kopien dieser Seite sind nur für den privaten, nicht kommerziellen Gebrauch gestattet. Soweit die Inhalte auf dieser Seite nicht vom Betreiber erstellt wurden, werden die Urheberrechte Dritter beachtet. Insbesondere werden Inhalte Dritter als solche gekennzeichnet. Sollten Sie trotzdem auf eine Urheberrechtsverletzung aufmerksam werden, bitten wir um einen entsprechenden Hinweis. Bei Bekanntwerden von Rechtsverletzungen werden wir derartige Inhalte umgehend entfernen.<br><br>

<b>Datenschutz</b><br><br>

Die Nutzung unserer Webseite ist in der Regel ohne Angabe personenbezogener Daten möglich. Soweit auf unseren Seiten personenbezogene Daten (beispielsweise Name, Anschrift oder eMail-Adressen) erhoben werden, erfolgt dies, soweit möglich, stets auf freiwilliger Basis. Diese Daten werden ohne Ihre ausdrückliche Zustimmung nicht an Dritte weitergegeben.<br><br>

Wir weisen darauf hin, dass die Datenübertragung im Internet (z.B. bei der Kommunikation per E-Mail) Sicherheitslücken aufweisen kann. Ein lückenloser Schutz der Daten vor dem Zugriff durch Dritte ist nicht möglich.<br><br>

Der Nutzung von im Rahmen der Impressumspflicht veröffentlichten Kontaktdaten durch Dritte zur Übersendung von nicht ausdrücklich angeforderter Werbung und Informationsmaterialien wird hiermit ausdrücklich widersprochen. Die Betreiber der Seiten behalten sich ausdrücklich rechtliche Schritte im Falle der unverlangten Zusendung von Werbeinformationen, etwa durch Spam-Mails, vor.
</article>
<?php
}
?>
</div>
</div>
<?php echo $footer; ?>
</body>
</html>