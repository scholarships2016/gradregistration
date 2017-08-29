/*
 * rate_per_period   - interest rate per month
 * number_of_payments   - number of periods (months)
 * present_value   - present value
 * future_value   - future value
 * type - when the payments are due:
 *        0: end of the period, e.g. end of month (default)
 *        1: beginning of period
 */
function calculatePmt(rate_per_period, number_of_payments, present_value, future_value, type) {
    if (rate_per_period > 0) {
        // Interest rate exists
        var q = Math.pow(1 + rate_per_period, number_of_payments);
        return (rate_per_period * (future_value + (q * present_value))) / ((-1 + q) * (1 + rate_per_period * (type)));
    } else if (number_of_payments > 0) {
        // No interest rate, but number of payments exists
        return (future_value + present_value) / number_of_payments;
    }
    return 0;
}