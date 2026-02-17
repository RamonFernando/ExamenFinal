namespace ApiCountries
{
    public class Country
    {
        [JsonPropertyName("name")]
        public CountryName? Name { get; set; }

        [JsonPropertyName("cca2")]
        public string? Cca2 { get; set; }

        [JsonPropertyName("cca3")]
        public string? Cca3 { get; set; }

        [JsonPropertyName("capital")]
        public List<string>? Capital { get; set; }

        [JsonPropertyName("region")]
        public string? Region { get; set; }

        [JsonPropertyName("subregion")]
        public string? Subregion { get; set; }

        [JsonPropertyName("population")]
        public long Population { get; set; }

        [JsonPropertyName("area")]
        public double Area { get; set; }

        [JsonPropertyName("currencies")]
        public Dictionary<string, CurrencyInfo>? Currencies { get; set; }

        [JsonPropertyName("languages")]
        public Dictionary<string, string>? Languages { get; set; }

        public static readonly List<Country> MyFavorites = new List<Country>();
    }

    public class CountryName
    {
        [JsonPropertyName("common")]
        public string? Common { get; set; }
        [JsonPropertyName("official")]
        public string? Official { get; set; }
    }

    public class CurrencyInfo
    {
        [JsonPropertyName("name")]
        public string? Name { get; set; }
        [JsonPropertyName("symbol")]
        public string? Symbol { get; set; }
    }
}
