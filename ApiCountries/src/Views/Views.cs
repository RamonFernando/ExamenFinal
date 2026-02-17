namespace ApiCountries
{
    public class Views
    {
        public static void ShowMainMenu()
        {
            Console.Clear();
            Console.WriteLine();
            Console.WriteLine("=== REST Countries API - Ramón F. Pérez Álvarez ===");
            Console.WriteLine("1. Buscar por País");
            Console.WriteLine("2. Listar Países Favoritos");
            Console.WriteLine("3. Eliminar País");
            Console.WriteLine("0. Salir");
            Console.Write("Seleccione una opción: ");
        }

        public static void ShowCountriesCount(List<Country> countries)
        {
            if (countries.Count == 1)
                Console.WriteLine($"Se encontró {countries.Count} país:");
            else
                Console.WriteLine($"Se encontraron {countries.Count} países:");
        }

        public static void ShowCountry(List<Country> countries)
        {
            Console.Clear();
            Console.WriteLine("\n=== Países ===");
            Console.WriteLine("===================\n");
            foreach (var c in countries)
            {
                var capital = c.Capital != null && c.Capital.Count > 0 ? string.Join(", ", c.Capital) : "N/A";
                var currencies = c.Currencies != null ? string.Join(", ", c.Currencies.Values.Select(x => x.Name ?? "")) : "N/A";
                var languages = c.Languages != null ? string.Join(", ", c.Languages.Values) : "N/A";
                Console.WriteLine(
                    $"Código: {c.Cca2} / {c.Cca3}\n" +
                    $"Nombre: {(c.Name?.Common ?? "N/A")}\n" +
                    $"Oficial: {(c.Name?.Official ?? "N/A")}\n" +
                    $"Capital: {capital}\n" +
                    $"Región: {(c.Region ?? "N/A")}\n" +
                    $"Subregión: {(c.Subregion ?? "N/A")}\n" +
                    $"Población: {c.Population:N0}\n" +
                    $"Área: {c.Area:N0} km²\n" +
                    $"Monedas: {currencies}\n" +
                    $"Idiomas: {languages}\n"
                );
            }
            Console.WriteLine($"Total: {countries.Count}");
            Console.WriteLine("===================\n");
        }

        public static void ShowCountriesFavorites(List<Country> countries)
        {
            Console.Clear();
            Console.WriteLine("\n=== Países Favoritos ===");
            Console.WriteLine($"Total: {countries.Count}");
            Console.WriteLine("===================\n");
            for (int i = 0; i < countries.Count; i++)
            {
                var c = countries[i];
                var capital = c.Capital != null && c.Capital.Count > 0 ? c.Capital[0] : "N/A";
                var continente = c.Region ?? "N/A";
                Console.WriteLine(
                    $"{i + 1}º. {c.Name?.Common ?? "N/A"} ({c.Cca2}) - Capital: {capital} - " +
                    $"Continente: {continente} - Habitantes: {c.Population:N0}"
                );
            }
        }

        public static void ShowCountriesByName(List<Country> countries)
        {
            Console.Clear();
            Console.WriteLine("\n=== Países Favoritos ===");
            Console.WriteLine($"Total: {countries.Count}");
            Console.WriteLine("===================");
            for (int i = 0; i < countries.Count; i++)
            {
                var country = countries[i];
                var continente = country.Region ?? "N/A";
                Console.WriteLine(
                    $"{i + 1}º: {(country.Name?.Common ?? "N/A")} ({country.Cca2}) - " +
                    $"Continente: {continente} - Habitantes: {country.Population:N0}"
                );
            }
            Console.WriteLine("===================");
        }

        public static void PrintPressToContinue()
        {
            Console.WriteLine("Presiona cualquier tecla para continuar...");
            Console.ReadKey();
        }
    }
}
