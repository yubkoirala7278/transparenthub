function availableYear(year = 2081) {
    const allYear = [
        [2000, 30, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31],
        [2001, 31, 31, 32, 31, 31, 31, 30, 29, 30, 29, 30, 30],
        [2002, 31, 31, 32, 32, 31, 30, 30, 29, 30, 29, 30, 30],
        [2003, 31, 32, 31, 32, 31, 30, 30, 30, 29, 29, 30, 31],
        [2081, 31, 32, 31, 32, 31, 30, 30, 30, 29, 30, 29, 31],
        // Add more years as needed
    ];

    // Find the year in the allYear array and return its corresponding array
    const yearData = allYear.find(item => item[0] === year);

    return yearData || null; // Return the array for the year, or null if not found
}



console.log(availableYear(2003));