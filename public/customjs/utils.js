function dateDifference(a, b) {
    var diffDays
    try {
        var timeDiff = Math.abs(a.getTime() - b.getTime());
        diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
    } catch (error) {
        return 0;
    }
    return diffDays;
}