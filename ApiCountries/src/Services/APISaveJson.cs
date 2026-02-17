namespace ApiCountries
{
    internal class APISaveJson
    {
        public static void APISaveFavoriteList()
        {
            try
            {
                string filePath = Path.Combine(AppDomain.CurrentDomain.BaseDirectory, "mis_paises.json");
                var json = JsonSerializer.Serialize(MyFavorites, new JsonSerializerOptions { WriteIndented = true });
                File.WriteAllText(filePath, json);
            }
            catch (Exception ex)
            {
                Console.WriteLine(ex.Message);
                PrintPressToContinue();
            }
        }
    }
}
