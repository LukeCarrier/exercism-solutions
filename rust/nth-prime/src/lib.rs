pub fn nth(n: u32) -> u32 {
    let mut primes = Vec::new();
    let mut i = 2;
    while primes.len() != (n as usize) + 1 {
        if is_prime(i) {
            primes.push(i)
        }
        i += 1;
    }
    *primes.last().expect("we ain't got no primes")
}

pub fn is_prime(n: u32) -> bool {
    if n == 1 {
        // 1 is the unit; it's not prime
        return false;
    }

    let max_divisor = (n as f32).sqrt().floor() as u32;
    for divisor in 2..=max_divisor {
        if n % divisor == 0 {
            return false;
        }
    }

    true
}
