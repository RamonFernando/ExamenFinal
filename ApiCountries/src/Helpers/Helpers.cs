namespace ApiCountries
{
    public class Helpers
    {
        public static bool isValidInputOption(string input, int min, int max)
        {
            if (!int.TryParse(input, out int option))
                return false;
            return option >= min && option <= max;
        }

        public static bool isValidInputString(string input)
        {
            return !string.IsNullOrEmpty(input);
        }
    }
}
