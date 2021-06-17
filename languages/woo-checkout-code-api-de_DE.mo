��    M      �  g   �      �  C   �     �  	   �  
   �  �   �  
   �     �     �     �  	   �  	   �     �     �  �     ;   �  5   �     	  $   	  !   6	  #   X	  6   |	  5   �	     �	     �	  �   
  �   �
     q       u   �  9        E  ;   c  �   �     :     K     Y     g     p  �   �  G   :  %   �     �     �  	   �     �     �     �  t         u  8   }  !   �     �     �     �          '  R   0  L   �  '   �     �  3     �   @  ^   -     �  v   �  +        J  W   W     �  D   �  
      	     (        >  	   C  
   M  �  X  1        N     c  
   q  �   |                '     H     P     ^     l     �  �   �  ;   N  C   �     �  *   �  *   �  @   )  J   j  ]   �  !        5  �   S  �   �     �  
   �  �   �  C   /  (   s  G   �  �   �     �     �     �     �     �  �   �  g   �  (          I      d      |      �      �      �   �   �      ^!  F   f!  2   �!  	   �!  %   �!  3   "  1   D"     v"  N   �"  S   �"  ?   '#     g#  D   z#  %  �#  a   �$  $   G%  �   l%  *   
&     5&  �   B&     �&  R   �&     %'  	   1'  (   ;'     d'  	   j'  	   t'     G   4   
   A   :   &   ;   J   +                3   M   (          I          %   8       #   	   =                   )   K       0   5         *                                  1   7       >      @   ?   -         H          E                L   6             .       C       D   9       /   ,      2                 $   '      <   F                                "   B   !    %1$s is ineffective as it requires %2$s to be installed and active. API DEV Mode API usage API-Action API-Action is an optional parameter telling the API, what shall be returned, value will be sent as parameter `action` in JSON-string or fieldname `action` in POST-array. API-Client API-Key API-Key Authentication API-URL Auth pass Auth user Authentication Type Basic Authentication Basic authentication works as known `user:pass` combination, API-Key-Authentication works with HTTP-header `api-client` and HTTP-header `api-key` Choose what kind of data you expext to be returned from API Choose what method should be used to send data to API Code Code API for Checkout in WooCommerce Code API for WooCommerce Checkout Codelist API got no host to connect Complete set returned from API example (click to show) Complete set sent to your API example (click to show) Data expected Data submitted Determine whether the code list should be displayed after successful checkout. The list is only displayed if the status of the order is `complete`. Determine whether the code list should be displayed on the thank you page, regardless of the further status of the order. Make sure you only offer payment options that have been successfully completed at this time. Email support Embedding preferences Enable or disable code API development mode. Development mode will show up more returning information in admin panel. Enable or disable code API usage for WooCommerce Checkout Error requesting codelist API Every product set submitted to API has following structure: For <strong>each</strong> product will be created a single entry. If your customer bought 2 variants of the same product, 2 codes expected to be returned. General settings Getting Codes Getting codes Helpdesc How does Woo Code API work? If API-Key-Authentification is set, the params <code>api-client</code> and <code>api-token</code> will be sent as <code>CURLOPT_HTTPHEADER</code> with their associated data. If an action param is set, it will be submitted as <code>action</code>. Is an authentication to API required? Items order ID Items product ID Items sku Items variation ID Metabox Override completed POST - data will be submitted as post values, JSON - ONE single string with a JSON-encoded dataset will be submitted Product Returning data count did not match requestest data count Returning data had to much values Save Select data return type Select data submit format Select data submit type Settings Setup whether the code list should be sent by email within the order confirmation. Setup whether the code list should be shown in order details page for admin. Strings as return are not supported yet Successful Checkout Tell API, where from and how to request a new code. The expected returning data for XML or JSON is a set of data with same length like product set and <code>n</code> elements with key <code>code</code> and a string as value that holds the full information that should be returned as code: The expected returning data for string format is just a list of codes, separeted by semikolon: There was no data returned This plugin adds support for returning digital codes from external service after successful payment provided by an API URL, that the cURL-request will be sent to. Woo Code API Woo Code API submits your product data to an external server you defined in "Get Codes" WooCommerce You can define here, which pages/elements will show up the codelist. Your codes appleuser https://profiles.wordpress.org/appleuser none returning submitting Project-Id-Version: Code API for Checkout in WooCommerce
PO-Revision-Date: 2020-02-26 17:46+0100
Last-Translator: 
Language-Team: 
Language: de_DE
MIME-Version: 1.0
Content-Type: text/plain; charset=UTF-8
Content-Transfer-Encoding: 8bit
X-Generator: Poedit 2.3
X-Poedit-Basepath: ..
Plural-Forms: nplurals=2; plural=(n != 1);
X-Poedit-Flags-xgettext: --add-comments=translators:
X-Poedit-WPHeader: woo-checkout-code-api.php
X-Poedit-SourceCharset: UTF-8
X-Poedit-KeywordsList: __;_e;_n:1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;esc_attr__;esc_attr_e;esc_attr_x:1,2c;esc_html__;esc_html_e;esc_html_x:1,2c;_n_noop:1,2;_nx_noop:3c,1,2;__ngettext_noop:1,2
X-Poedit-SearchPath-0: .
X-Poedit-SearchPathExcluded-0: *.min.js
 %1$s benötigt eine aktive Installation von %2$s. API Entwickler Modus API Benutzung API-Aktion Der "API-Aktion"-Parameter wird als `action`-Variable mitgeschickt und kann der API so sagen, welche Daten zurückgeschickt werden sollen. API-Benutzername API-Schlüssel API-Schlüssel-Authentifizierung API-URL Auth Passwort Auth Benutzer Authentifizierungstyp Standardauthentifizierung Die Standardauthentifizierung arbeitet mit der bekannten `benutzer:passwort` Kombination, die API-Schlüssel-Authentifizierung schickt die HTTP-Header `api-client` und `api-key` Wähle, welche Daten du als Rückgabe von der API erwartest Wähle, welche Methode benutzt werden soll, um die API anzusprechen Code Code API für die WooCommerce Bestellseite Code API für die WooCommerce Bestellseite Es wurde kein Host definiert, zu dem sich die API verbinden soll Beispiel für einen kompletten Datensatz von der API (Klicke zum Anzeigen) Beispiel für einen kompletten Datensatz, der an die API geschickt wird (Klicke zum Anzeigen) Daten, die zurückerwartet werden Daten, die übertragen werden Aktiviere die Anzeige der Codeliste nach erfolgreichem Kauf. Die Liste wird nur angezeigt, wenn der Status der Bestellung „Abgeschlossen“ ist. Aktiviere die Anzeige der Codeliste unabhängig vom Status der Bestellung. Stelle aber besser sicher, dass zu diesem Zeitpunkt wirklich für die Codes bezahlt wurdest. E-Mail Einbettung Der API Entwickler Modus bietet die Anzeige weiterer Informationen aus der Kommunikation zwischen Wordpress und dem API-Server im Admin-Panel. Aktiviere/Deaktiviere die Nutzung der Codelist-API für WooCommerce Fehler beim Anfordern der Codelisten-API Jeder Produktdatensatz, der übertragen wird, hat den folgenden Aufbau: Für <strong>jedes</strong> Produkt wird ein einzelner Eintrag erzeugt. Wenn dein Kunde also zwei Varianten des selben Produktes kauft, werden auch zwei Codes zurück erwartet. Allgemeine Einstellungen Codes abrufen Codes abrufen Hilfe Wie arbeitet die Woo Code API? Wenn die API-Schlüssel-Authentifizierung aktiviert ist, werden die Parameter <code>api-client</code> und <code>api-token</code> als <code>HTTP-Header</code> mit den entsprechenden Daten übermittelt. Der „API-Aktion“-Parameter wird als <code>action</code>-Variable mitgeschickt, wenn er gesetzt ist. Ist eine Authentifizierung erforderlich? Bestellnummer des Elements Produkt-ID des Elements Artikelnummer des Elements Varianten-ID des Elements Metabox Übergehe ‚Abgeschlossen‘ POST-Daten werden als Array übermittelt, JSON-Daten werden vorher per JSON-Encode verarbeitet und dann als einzelner String geschickt Produkt Die zurückgegebenen Daten entsprachen nicht der erwarteten Datenmenge Der zurückgegebene Datensatz hatte zu viele Werte Speichern Wähle den Rückgabetyp der API-Daten Wähle das Format, in dem Daten übermittelt werden Wähle, wie die Daten zur API übermittelt werden Einstellungen Aktiviere die Anzeige der Codeliste in der Bestätigungs- bzw. Abschlussemail. Aktiviere die Anzeige der Codeliste auf der Bestellübersichtsseite im Admin-Panel. STRINGS sind als Rückgabewert derzeit noch nicht implementiert Kauf abgeschlossen Definiere hier, woher - und wie - die API neue Codes anfordern kann. Die erwartete Rückgabe für XML oder JSON ist ein Datensatz mit der selben Länge wie der Produktdatensatz und <code>n</code> Elementen mit dem Schlüsselwert <code>code</code> und einem string als Wert, der die komplette Information zum Code enthält, die dem Benutzer angezeigt werden soll: Die erwartete Rückgabe für einen STRING ist eine Liste von Codes, getrennt von einem Semikolon: Es wurden keine Daten zurückgegeben Dieses Plugin erweitert WooCommerce um die Möglichkeit, digitale Codes über eine externe API abzurufen und dem Käufer nach Kaufabschluss bereit zu stellen URL, an die die Anforderung gesendet wird. Woo Code API Die Woo Code API übermittelt deine Produktdaten an einen externen Server, den du im Bereich „Codes abrufen“ definieren kannst. WooCommerce Du kannst hier definieren, auf welchen Seiten die Codeliste angezeigt werden soll. Deine Codes appleuser https://profiles.wordpress.org/appleuser Keine rueckgabe datensatz 