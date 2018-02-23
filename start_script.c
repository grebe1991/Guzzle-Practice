#include <stdio.h>
#include <unistd.h>
#include <stdlib.h>
#include <string.h>
#include <dirent.h>

int main(int argc, char **argv)
{
    if (argc == 2)
    {
        // just for practice
        char *command;

        if ((command = (char *)malloc(strlen(argv[1]) + strlen("php index.php ") + 1)) != NULL)
        {
            command[0] = '\0';
            command = strcat(command, "php index.php ");
            command = strcat(command, argv[1]);
            printf("%s\n", command);
        }
        else
        {
            printf("The program encountered an error");
            exit(-1);
        }
        return execl("/usr/bin/php", "/usr/bin/php", "index.php", argv[1], NULL);
    }
    else
    {
        printf("%s", "\nPlease choose a valid script to execute. Type \"./guzzle --help\" to get available options\n\n");
    }
}