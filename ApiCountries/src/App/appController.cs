namespace ApiCountries
{
    public class AppController
    {
        public static async Task Run()
        {
            APILoadFavoriteList();
            await PreloadCountriesFromCVAsync();
            int min = 0; int max = 3;
            while (true)
            {
                ShowMainMenu();
                string? input = Console.ReadLine();
                if (!isValidInputOption(input!, min, max))
                {
                    Console.WriteLine($"Opción inválida. Debe introducir un número entre {min} y {max}.");
                    PrintPressToContinue();
                    continue;
                }
                int option = int.Parse(input!);
                switch (option)
                {
                    case 1:  await SearchByNameAsync();        break;
                    case 2:  ListAllCountries();              break;
                    case 3:  DeleteCountry();                 break;
                    case 0:
                        Console.WriteLine("Saliendo...");
                        Environment.Exit(0);
                        return;
                    default:
                        Console.WriteLine("Opción inválida. Intente de nuevo.");
                        break;
                }
            }
        }

        private static async Task PreloadCountriesFromCVAsync()
        {
            if (MyFavorites.Count > 0) return;
            string[] cvCountries = { "CUB", "ESP", "RUS" };
            foreach (var code in cvCountries)
            {
                var country = await GetCountryByAlphaAsync(code);
                if (country != null && !ApiSearchByName.ExistCountry(country.Cca2 ?? "", MyFavorites))
                {
                    MyFavorites.Add(country);
                }
            }
            if (MyFavorites.Count > 0) APISaveFavoriteList();
        }
    }
}
