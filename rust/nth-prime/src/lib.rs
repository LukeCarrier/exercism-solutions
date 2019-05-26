pub fn nth(n: u32) -> u32 {
    (2..)
        .filter(|&i| is_prime(i))
        .nth(n as usize)
        .expect("we ain't got no primes")
}

pub fn is_prime(n: u32) -> bool {
    match n {
        1 => false,
        2 => true,

        _ if n % 2 == 0 => false,

        _ => {
            let max_divisor = (n as f32).sqrt().floor() as u32;
            !(3..=max_divisor)
                .step_by(2)
                .any(|d| n % d == 0)
        },
    }
}
