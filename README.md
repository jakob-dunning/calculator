
### Szenario

#### Server-seitiger Taschenrechner

Einer Auftraggeber möchte einen einfachen Taschenrechner programmiert bekommen, den er später auf seinen Seiten einbinden kann. Die besondere Anforderung besteht nun darin, dass der Rechner auch funktionieren soll, wenn der Benutzer sowohl Javascript UND Cookies abgeschaltet hat.

[calculator.zip](calculator.zip)

Du als PHP-Programmierer erhältst nun das vorliegende HTML-Template von der Frontend-Abteilung zur weiteren Verarbeitung.

### Aufgabe

- Setze bitte beispielhaft zwei der dargestellten Grundrechenarten für ganze positive Zahlen um (z.B. Addition und Subtraktion). 
- Bei der Eingabe von mehrziffrigen Zahlen sollte sich die Anzeige wie bei einem "richtigen" Taschenrechner verhalten, d.h. die Zahl sollte nach und nach im Displayfenster von rechts "wachsen".
- Auch das Aneinanderreihen von Rechenoperationen sollte funktionieren, mit der Darstellung der jeweiligen Zwischenergebnisse im Aufgabefeld. 
- Zuletzt sollte auch der Button "C" (Clear) funktionieren und den Rechner auf den Ursprungszustand zurücksetzen, als auch der Button "=", der das Ergebnis anzeigt.
- Mit späteren Erweiterungen ist fest zu rechnen. Strukturiere bitte deinen Code so, dass er gut erweiterbar bleibt.

### Anmerkungen

- Uns interessiert hierbei vor allem, wie du die Anforderung löst, dass WEDER Javascript NOCH Cookies auf der Clientseite erlaubt sind. 
- Außerdem ist uns wichtig zu sehen, wie du die Codestruktur aufbaust, die nötig ist, um dem Taschenrechner später um neue Funktionen zu erweitern.
- Wenn du Fragen zum Verhalten des Taschenrechners (z.B. "Was passiert in Anzeige und Ergebnis, wenn ich '3+=' eingebe?") hast, orientiere dich am Verhalten des Standardrechners deines Betriebsystems ('calc.exe' etc.).
- Du musst keine Riesenkommentare schreiben o.ä., bedenke einfach, dass der Code verständlich sein sollte.

### Zeitaufwand

Wir denken, dass die Aufgabe in ca. 4 Stunden lösbar ist. Du musst die Aufgabe nicht unbedingt beenden, aber die Grundstrukturen des Code sollten stehen und der weitere Lösungsweg sichtbar werden. Schreib einfach dazu, was funktioniert und was noch nicht.

### Hilfsmittel

Du musst nicht, aber du kannst z.B. PHP-Frameworks oder auch Composer benutzen. Wir werden versuchen, deinen Code testweise auf Apache 2.4/PHP 5.5 mit Standardausstattung laufen zu lassen, aber dein PHP-Code steht im Vordergrund, nicht die Installationsroutinen. Sollte die Installation vom Standard abweichen, dann gib kurz stichpunktartig die Schritte an.

