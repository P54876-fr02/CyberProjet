#include <stdio.h>
#include <string.h>
#include <unistd.h>

#define MAX_ATTEMPTS 2
#define COOLDOWN_TIME 60  // in seconds

int check_credentials(char* username, char* password) {
    // Vérifie les informations de connexion ici
    return 1;  // renvoie 1 si les informations sont correctes, 0 sinon
}

int login(char* username, char* password) {
    int attempts = 0;
    while (attempts < MAX_ATTEMPTS) {
        if (check_credentials(username, password)) {
            return 1;
        }
        attempts++;
        sleep(COOLDOWN_TIME);
    }
    return 0;
}

int main() {
    char username[100];
    char password[100];

    printf("Nom d'utilisateur : ");
    scanf("%s", username);

    printf("Mot de passe : ");
    scanf("%s", password);

    if (login(username, password)) {
        printf("Connexion réussie.\n");
    } else {
        printf("Erreur 404 : page non trouvée.\n");
    }
    return 0;
}