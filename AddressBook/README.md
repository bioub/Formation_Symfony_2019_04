## Exercice Router

### Créer 3 pages sur des contacts (dans ContactController)

* list() -> GET /contacts/
* show($id) -> GET /contacts/{id}
* add() -> GET/POST /contacts/add

### Tests automatisés

#### Tests unitaires

Tester les méthodes setId et getId de App\Entity\Contact

#### Tests fonctionnels

* Dans App\Manager\ContactManager, ajouter une méthode getById($id) (qui retourne le contact correspondant)
* Appeler cette méthode depuis la méthode show de ContactController
* Ecrire un test fonctionnel avec un mock de ContactManager qui vérifie que les prénoms, noms et emails s'affichent
