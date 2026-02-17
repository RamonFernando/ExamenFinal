namespace ApiCountries
{
    public static class ApiSearchByName
    {
        public static async Task SearchByNameAsync()
        {
            Console.WriteLine("=== Buscar País por Nombre ===");
            Console.WriteLine("Ingrese el nombre: (Spain, France, etc.)");
            string? name = Console.ReadLine();
            if (!isValidInputString(name!))
            {
                Console.WriteLine("El nombre no puede estar vacío.");
                PrintPressToContinue();
                return;
            }
            try
            {
                var list = await GetCountriesAsync($"{BaseUrl}/name/{Uri.EscapeDataString(name!)}");
                if (list == null || list.Count == 0)
                {
                    Console.WriteLine($"No se encontró país con el nombre '{name}'.");
                    PrintPressToContinue();
                    return;
                }
                ShowCountriesCount(list);
                ShowCountry(list);
                AskSaveToFavorites(list);
                PrintPressToContinue();
            }
            catch (Exception ex)
            {
                Console.WriteLine($"Error: {ex.Message}");
                PrintPressToContinue();
            }
        }

        public static bool ExistCountry(string cca2, List<Country> favorites)
        {
            if (string.IsNullOrEmpty(cca2)) return false;
            return favorites.Any(c => c.Cca2 != null && c.Cca2.Equals(cca2, StringComparison.OrdinalIgnoreCase));
        }

        public static bool TryAddRangeCountry(List<Country> items, List<Country> favorites)
        {
            if (items == null || favorites == null || !items.Any()) return false;
            favorites.AddRange(items);
            return true;
        }

        public static void AskSaveToFavorites(List<Country> countries)
        {
            Console.WriteLine("¿Desea guardar en favoritos? (s/n): ");
            string? saveInput = Console.ReadLine()?.Trim().ToLower();
            if (saveInput != "n" && saveInput != "s")
            {
                Console.WriteLine("Carácter no válido. Debe ingresar 's' o 'n'.");
                return;
            }
            if (string.IsNullOrEmpty(saveInput) || saveInput == "n")
            {
                Console.WriteLine("No se guardó en la lista de favoritos.");
                return;
            }
            foreach (var c in countries)
            {
                if (string.IsNullOrEmpty(c.Cca2)) continue;
                if (ExistCountry(c.Cca2, MyFavorites)) { Console.WriteLine($"'{c.Name?.Common}' ya está en favoritos."); continue; }
                TryAddRangeCountry(new List<Country> { c }, MyFavorites);
            }
            APISaveFavoriteList();
            ShowCountriesByName(MyFavorites);
            Console.WriteLine("Se guardó en favoritos.");
        }
    }
}
