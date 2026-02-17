namespace ApiCountries
{
    public class RequestGetAsync
    {
        public static string BaseUrl => "https://restcountries.com/v3.1";

        public static async Task<List<Country>?> GetCountriesAsync(string url)
        {
            using HttpClient client = new HttpClient();
            HttpResponseMessage response = await client.GetAsync(url);
            if (!response.IsSuccessStatusCode)
            {
                if (response.StatusCode == HttpStatusCode.NotFound) return new List<Country>();
                Console.WriteLine("Error al obtener los datos. Estado: " + response.StatusCode);
                return null;
            }
            string json = await response.Content.ReadAsStringAsync();
            var list = JsonSerializer.Deserialize<List<Country>>(json);
            return list ?? new List<Country>();
        }

        public static async Task<Country?> GetCountryByAlphaAsync(string code)
        {
            string url = $"{BaseUrl}/alpha/{Uri.EscapeDataString(code)}";
            var list = await GetCountriesAsync(url);
            return list?.FirstOrDefault();
        }
    }
}
