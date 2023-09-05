# uruchomienie serwera
symfony.exe server:start
nasłuch powinien być standardowo pod adresem http://127.0.0.1:8000

środowisko produkcyjne php 7.2.7

# endpointy
POST **/api/message** - Tworzenie wiadomości (POST)
do wywołania metody można użyć: curl -X POST -H "Content-Type: application/json" -d '{"message": "tresc_wiadomosci"}' http://127.0.0.1:8000/api/message

lub można uruchomić testowy formularz http://127.0.0.1:8000/create.html i tam wpisać jakąś treść i potwierdzić dodanie

GET **/api/messages** - Zwraca listę wszystkich wiadomości

GET **/api/message/{uuid}** - Zwraca konkretną wiadomość po wskazanym uuid

# baza danych 
wiadomości są magazynowane w formie plików w folderze "messages"


autor:
Michał Rygielski
kontakt@michalrygielski.pl