namespace ApiCountries
{
    public class ApiDeleteCountry
    {
        public static void DeleteCountry()
        {
            Console.Clear();
            Console.WriteLine("=== Eliminar País de Favoritos ===");
            ShowCountriesByName(MyFavorites);
            Console.WriteLine("Ingrese el código alpha (cca2) del país a eliminar: (ES, MX, etc.)");
            string? code = Console.ReadLine();
            if (!isValidInputString(code!))
            {
                Console.WriteLine("El código no puede estar vacío.");
                PrintPressToContinue();
                return;
            }
            if (!TryDeleteCountryByCode(code!))
            {
                Console.WriteLine($"No se encontró el país '{code}' en la lista de favoritos.");
                PrintPressToContinue();
                return;
            }
            Console.WriteLine($"El país '{code}' ha sido eliminado de favoritos.");
            APISaveFavoriteList();
            PrintPressToContinue();
        }

        public static bool TryDeleteCountryByCode(string cca2)
        {
            if (string.IsNullOrEmpty(cca2)) return false;
            var c = MyFavorites.FirstOrDefault(x => x.Cca2 != null && x.Cca2.Equals(cca2, StringComparison.OrdinalIgnoreCase));
            return c != null && MyFavorites.Remove(c);
        }
    }
}
