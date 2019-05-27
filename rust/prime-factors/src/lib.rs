pub fn factors(mut n: u64) -> Vec<u64> {
    let mut factors = vec![];

    while n > 1 {
        let i = (2..).find(|i| n % i == 0).unwrap();
        factors.push(i);
        n /= i;
    }

    factors
}
