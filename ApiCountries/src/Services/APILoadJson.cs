namespace ApiCountries
{
    internal class APILoadJson
    {
        public static void APILoadFavoriteList()
        {
            try
            {
                string filePath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "mis_paises.json");
                if (!File.Exists(filePath))
                {
                    Console.WriteLine("El archivo no existe. Se creará uno nuevo.");
                    File.WriteAllText(filePath, JsonSerializer.Serialize(new List<Country>()));
                    PrintPressToContinue();
                    return;
                }
                var json = File.ReadAllText(filePath);
                var loaded = JsonSerializer.Deserialize<List<Country>>(json) ?? new List<Country>();
                MyFavorites.Clear();
                MyFavorites.AddRange(loaded);
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                PrintPressToContinue();
            }
        }
    }
}
